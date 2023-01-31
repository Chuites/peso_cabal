<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //---Form components
        //text input
        Form::component('inputText', 'components.form.text', ['name', 'value', 'attributes', 'label', 'class', 'isRequired']);
        //select input
        Form::component('inputSelect', 'components.form.select', ['name', 'options', 'value', 'attributes', 'label', 'class', 'show_all', 'placeholder', 'noText', 'isRequired']);        
        //hidden input
        Form::component('inputHidden', 'components.form.hidden', ['name', 'value', 'attributes']);
        //date input
        Form::component('inputDate', 'components.form.date', ['name', 'value', 'attributes', 'label', 'class', 'isRequired']);
        //time input
        Form::component('inputTime', 'components.form.time', ['name', 'value', 'attributes', 'label', 'class', 'isRequired']);
        //text area
        Form::component('inputArea', 'components.form.area', ['name', 'value', 'attributes', 'label', 'class', 'isRequired']);
        //botones
        Form::component('boton', 'components.form.botones', ['id', 'opcion', 'tag', 'texto', 'clase', 'otros', 'url']);
        //email input
        Form::component('inputEmail', 'components.form.email', ['name', 'value', 'attributes', 'label', 'class', 'isRequired']);
    }
}
