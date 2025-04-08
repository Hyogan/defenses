<?php
namespace Core;

use App\Models\Auth;

class Controller {
    protected function view($view, $data = [], $layout='default') {
      extract($data);
      // Capture le contenu de la vue
      ob_start();
      include APP_PATH . "/Views/{$view}.php";
      $content = ob_get_clean();
  
      // Charger le bon layout
      include APP_PATH . "/Views/layouts/{$layout}.php";
    }
    
    /**
     * Rediriger vers une URL
     */
    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }
    
    /**
     * Renvoyer une réponse JSON
     */
    protected function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    public function checkAuth() 
    {
        if(!Auth::isLoggedIn()) 
        {
          return $this->redirect('/');
        }
    }
}

