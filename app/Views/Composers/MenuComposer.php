<?php

namespace App\Views\Composers;

class MenuComposer{
    public function compose($view){

            $menu = [
                'Home' => '/',
                'About' => '/about',
                'Contact' => '/contact',
            ];

            $authenticated = true;

            if ($authenticated) {
                $menu = array_merge($menu, [
                    'Logout' => '/logout',
                    'Profile' => '/profile',
                    'Dashboard' => '/dashboard'
                ]);
            }

            $view->with('menu', $menu);
    }
}

?>
