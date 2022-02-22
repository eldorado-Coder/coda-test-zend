<?php

namespace App\Handler\Project;

/**
 * Description of RemoveHandler
 * 
 * @OA\Get(
 *     path="/project/remove/{id}",
 *     summary="Project Revove",
 *     tags={"Project"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaJsonResponse")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class RemoveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = \App\Model\Project::find($itemId);
        // verificar si existe
        if($item === null){
            return \App\Factory\ErrorFactory::notExist();
        }
        $item->deleted = 1;
        $item->save();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}