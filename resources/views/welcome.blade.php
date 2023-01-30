<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .search {
            width: 500px;
        }

        .div_search {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .my-custom-scrollbar {
            position: relative;
            height: 78vh;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        .card-image-custom {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-top: 25px;
        }

        .contribuitor-image {
            width: 100px;
            border-radius: 50%;
            margin-left: -40px;
            border: 1px solid black;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            padding: 1px;
        }

        body {
            background-image: linear-gradient(95.2deg, rgba(173, 252, 234, 1) 26.8%, rgba(192, 229, 246, 1) 64%);
        }
    </style>
    <title>Test Application</title>
</head>
<body>

<div class="container-fluid">
    <div class="row" style="display: flex; flex-direction: row; justify-content: center; justify-items: center; text-align: center">
        <h4 class="mt-3">Encontre organizações no GitHub</h4> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
        <div class="input-group mt-1 mb-4 search" style="border-radius: 20px 20px 20px 20px;">
            <input type="text" id='el_search' class="form-control" placeholder="Busque por organizações no Github">
            <span class="input-group-text" onclick="findOrganization()" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                     viewBox="0 0 16 16">
  <path
      d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg>
              </span>
        </div>
    </div>
    <div class="row">

        <div class="col-sm">
            <hr>
            <div class="div_search" id="el_div_search">
                <svg xmlns="http://www.w3.org/2000/svg" width="70%" height="70%" fill="currentColor"
                     class="bi bi-search"
                     viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
            </div>
            <div class="card" style="width: 100%; text-align: center;border-radius: 20px 20px 20px 20px;" id="el_card">
                <div class="card-image-custom">
                    <img class="card-img-top" id="el_image" style="width: 200px">
                </div>
                <div class="card-body">
                    <h5 class="card-title" id="el_org"></h5>
                    <p class="card-text" id="el_description"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Login</span>
                                    </div>
                                    <input type="text" disabled class="form-control" id="el_login"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Criado em</span>
                                    </div>
                                    <input type="text" disabled class="form-control" id="el_created_at"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Site</span>
                                    </div>
                                    <input type="text" disabled class="form-control" id="el_site"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">GitHub</span>
                                    </div>
                                    <input type="text" disabled class="form-control" id="el_github_link"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h5>Alguns contribuidores</h5>
                        <ul id="el_contribuitors_images" style="list-style-type:none; display: flex;
                         flex-direction: row; justify-content: center"></ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col">
            <hr>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Organização</th>
                        <th scope="col">Url</th>
                        <th scope="col">Linguagem</th>
                    </tr>
                    </thead>
                    <tbody id="el_table_body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.6/axios.min.js"
        integrity="sha512-RUkwGPgBmjCwqXpCRzpPPmGl0LSFp9v5wXtmG41+OS8vnmXybQX5qiG5adrIhtO03irWCXl+z0Jrst6qeaLDtQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="application/javascript">

    document.getElementById('el_div_search').hidden = false;
    document.getElementById('el_card').hidden = true;

    refreshSavedRepositories();

    function findOrganization() {

        const organizationName = document.getElementById('el_search').value;
        if (organizationName === '') {
            alert('Ops... Digite o nome da organização que deseja encontrar.');
            return;
        }

        axios.get(`/api/organizations/${organizationName}/find`)
            .then(function (data) {
                console.log(data.status)
                if (data.status === 200) {
                    const orgData = data.data
                    document.getElementById('el_image').src = orgData.avatar_url
                    document.getElementById('el_org').innerText = orgData.name;
                    document.getElementById('el_description').innerText = orgData.description;
                    document.getElementById('el_login').value = orgData.login;
                    document.getElementById('el_site').value = orgData.blog;
                    document.getElementById('el_created_at').value = dataAtualFormatada(orgData.created_at);
                    document.getElementById('el_github_link').value = orgData.html_url;
                    refreshSavedRepositories();
                    getContributorImages(organizationName);
                    if(orgData.name !== undefined){
                        document.getElementById('el_div_search').hidden = true;
                        document.getElementById('el_card').hidden = false;
                    }else alert('Nenhuma organização encontrada com esse nome.')
                }else{
                    alert('Limite de requisições excedidas para essa máquina, ou algum erro desconhecido aconteceu.')
                }
            })
    }

    function getContributorImages(organization) {
        axios.get(`https://api.github.com/orgs/${organization}/public_members?=&per_page=5`)
            .then(function (data) {
                const contribuitorsData = data.data;
                let imagesHtml = '';
                contribuitorsData.forEach((contribuitor) => {
                    imagesHtml += `<li><img src="${contribuitor.avatar_url}"
                        title="${contribuitor.login}" class="contribuitor-image"
                        style="margin-left:-20px"></li>`;
                });
                document.getElementById('el_contribuitors_images').innerHTML = imagesHtml;
            });
    }

    function refreshSavedRepositories() {
        axios.get(`/api/organizations/saved-repositories`)
            .then(function (data) {
                const repositories = data.data
                let bodyHtml = '';
                repositories.forEach((repository) => {
                    bodyHtml += `<tr><td>${repository.name}</td><td>${repository.organization}</td>
                                    <td>${repository.url}</td><td>${repository.lang}</td></tr>`
                });
                document.getElementById('el_table_body').innerHTML = bodyHtml;
            })
    }

    function dataAtualFormatada(date) {
        let data = new Date(date),
            dia = data.getDate().toString(),
            diaF = (dia.length === 1) ? '0' + dia : dia,
            mes = (data.getMonth() + 1).toString(),
            mesF = (mes.length === 1) ? '0' + mes : mes,
            anoF = data.getFullYear();
        return diaF + "/" + mesF + "/" + anoF;
    }
</script>
</body>
</html>
