<?php

namespace App\Handler\Client;

use GPBMetadata\Google\Protobuf\Timestamp;
use GPBMetadata\Google\Type\Date;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/client/save",
 *     summary="Client Save",
 *     tags={"Client"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Client")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Client")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class SaveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        $user = $this->getUser($request);
        if($user->title != 'Editor') 
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, "your permission required");
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->name = $this->getParam($request, 'name', '');
        $item->surname = $this->getParam($request, 'surname', '');        
        $item->email = $this->getParam($request, 'email', '');        
        $item->deleted = 0;
        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \App\Model\Client
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = \App\Model\Client::find($itemId);
        // verificar si existe

        if($item === null){
            return new \App\Model\Client();
        }
        // Devolvemos item para editar
        return $item;
    }
}