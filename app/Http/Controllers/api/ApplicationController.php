<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class ApplicationController extends Controller
{
    private string $githubApiBaseUrl;
    private Client $httpClient;

    public function __construct()
    {
        $this->githubApiBaseUrl = env('GITHUB_API_BASE_URL');
        $this->httpClient = new Client(['verify' => false]);
    }

    public function getOrganization(string $organization): stdClass | string
    {
        try {
            $result = $this->httpClient->get($this->githubApiBaseUrl . '/orgs/' . $organization);
            $this->getRepositories($organization);
            return json_decode($result->getBody());
        }catch (ClientException $e){
            if($e->getCode() == 404){
                return 'Organização não encontrada.';
            }
            return 'Ocorreu algum erro!';
        }
    }

    private function getRepositories(string $organization): void
    {
        $repositories = collect(json_decode($this->httpClient
            ->get($this->githubApiBaseUrl . '/orgs/' . $organization . '/repos?per_page=10&sort=created')
            ->getBody()));
        DB::beginTransaction();

        try {
            $repositories->each(function ($repo) use ($organization) {
                /*
                 * Tenho conhecimento que requests dentro de loop não é nada
                 * performático nesse caso, mas não encontrei nenhum atributo
                 * com a quantidade de commits
                 */
                if($this->countRepositoryCommits($organization, $repo->name) > 10){
                //if (11 > 10) {

                    $repositoryName = $repo->name;
                    $repositoryUrl = $repo->html_url;
                    $repositoryOrganization = $organization;
                    $repositoryLang = $repo->language;

                    $exists = Repository::where('name', '=', $repositoryName)
                        ->where('organization', '=', $repositoryOrganization)
                        ->first();

                    if (!$exists) {
                        Repository::insert([
                            'name' => $repositoryName,
                            'url' => $repositoryUrl,
                            'organization' => $repositoryOrganization,
                            'lang' => $repositoryLang
                        ]);
                    }
                }
            });
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function countRepositoryCommits(string $organization, string $repositoryName): int
    {
        return collect(json_decode($this->httpClient
            ->get($this->githubApiBaseUrl . '/repos/' . $organization . '/' . $repositoryName . '/commits')
            ->getBody()))->count();
    }

    public function getSavedRepositories(): Collection
    {
        return Repository::all();
    }
}
