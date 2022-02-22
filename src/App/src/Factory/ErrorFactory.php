<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Factory;

/**
 * Description of ErrorFactory
 *
 * @author matiascamiletti
 */
class ErrorFactory 
{
    public static function companyNotExist(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(100, 'This company not exist.'); }
    public static function companyNotPermission(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(101, 'You haven`t access to company.'); }
    
    public static function emailRequired(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(2, 'The email is required'); }
    
    
    public static function notExist(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'No se ha encontrado el elemento.'); }
    public static function paramRequired(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(2, 'No se han enviado parametros obligatorios'); }
    public static function permissionExist(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(3, 'Ya se posee permisos.'); }
    public static function documentDeleted(){ return new \Mia\Core\Diactoros\MiaJsonErrorResponse(4, 'El documento ya no se encuentra disponible, contactar al administrador'); }
}