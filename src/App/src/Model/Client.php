<?php

namespace App\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $user_id Description for variable
 * @property mixed $title Description for variable
 * @property mixed $caption Description for variable
 * @property mixed $created_at Description for variable
 * @property mixed $updated_at Description for variable
 * @property mixed $deleted Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="name",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="surname",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="email",
 *  type="string",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class Client extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'client';
    
    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('client.deleted', 0);
        });
    }
}