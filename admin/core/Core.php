<?php
class Core {

    public function iniciar() {
         
        $url = '/';
        if(isset($_GET['url'])) {
            $url.= $_GET['url'];
        }

        $params = array();

        //verifica se existe alguma coisa na url após a barra
        if(!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url); //remove o primeiro registro do array, pois não adicona nada ao array

            $controllerAtivo = $url[0].'Controller';
            array_shift($url); // remove novamente a primeira opção do array, pois já foi usada acima.

            if(isset($url[0]) && !empty($url[0])) {
                $acaoAtiva = $url[0];
                array_shift($url); //remove novamente primeira opção do array para que sobre apenas os parâmetros
            } else {
                $acaoAtiva = 'index';
            }

            //verifica se existe alguma coisa na url ainda, caso sim, são parâmetros
            if(count($url) > 0) {
               $params = $url;
            }

        } else {
            $controllerAtivo = 'DashboardController';
            $acaoAtiva = 'index';
        }

        $controller = new $controllerAtivo();

        //Essa pega a classe [$controller] e executa a ação. Também passa os parâmetros se existir.
        call_user_func_array(array($controller, $acaoAtiva), $params);

    }
}
?>