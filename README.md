# API_STAR_WARS

API que pegará as informações de um determinado lugar, uma URL e apresentará em tela as informações dos personagens da saga Star Wars ou conhecida anteriormente como Guerra nas Estrelas.

## Como fazer funcionar

* Abra o docker do seu PC, caso não tenha, baixe o mesmo.
* Após baixa-lo, antes de começar a instalar o Docker, você deve atualizar o seu WSL através do powershell em modo admin.
* Para colocar o Powershell em modo admin faça:
* -Vá na pesquisa do Windows 10 ou 11, digite Powershell e clique em cima dele com o botão direto, vão aparecer varias opções, uma delas é "Executar como modo administrador", escolha essa, depois ele irá confirmar, clique em sim e pronto, seu Powershell está em modo admin.
* -Digite wsl --version, ele mostrará informações sobre o seu wsl, veja a versão dele, se for a 2, está certinho, senão você deve atualizar para a versão 2.

* Pode ser que seu WSL não esteja instalado, use o comando "wsl --install" para instalar ele, este comando geralmente busca a versão mais recente do WSL, após isto, reinicie a máquina.
* -Atualizando para a versão 2 do WSL, use o comando "wsl.exe --update --pre-release", depois reinicie a máquina.
* -Depois de estar com o WSL 2, você precisa instalar uma versão do Linux na máquina para que o Docker funcione, use o comando "wsl.exe --list --online" para ver todas as versões disponíveis do Linux.
* -Para instalar a versão do Linux use o comando "wsl.exe --install <DistroName>", substituindo <DistroName> pelo nome da distribuição que você deseja usar, depois disto Linux estará disponível e você poderá instalar o Docker, o processo de instalação do Docker é instintivo, não precisa de tutorial.

* Caso não queira usar pelo Docker e esteja usando o xampp ou wampp, coloque o projeto na pasta https.
* Abra o seu Visual Studio Code, caso não tenha e não queira instalar, abra o seu powershell no modo admin.

## Usando o Visual Studio Code com o Docker aberto

* Abra o seu Visual Studio Code e abra o seu projeto, com o projeto aberto use as teclas para habilitar o terminal "CTRL+SHIFT+'", ao abrir o terminal veja se está escrito no topo do canto direito do terminal uma palavrinha "bash", se estiver use o comando "docker-compose up -d --build", assim ele irá testar os arquivos da criação de um container Docker, e criará um ambiente para desenvolvimento e utilização do sistema.

## Usando o Powershell em modo admin

* Use o comando "cd .." para voltar uma pasta.
* Use o comando "cd nomeDaPasta", troque "nomeDaPasta" pelo nome da pasta que quer abrir, até chegar na pasta do projeto.
* Na pasta do projeto digite o seguinte comando "docker compose up -d --build", assim será criado o container no Docker, o ambiente estará pronto para uso.

## Depois de tudo isto

* Abra seu Docker e veja se todas as atividades do container estão funcionando perfeitamente.
* Tudo estando certo, abra seu navegador e digite "https://localhost:8080", a tela inicial do projeto aparecerá, daí é só iniciar a pesquisa sobre os personagens do Star Wars.
