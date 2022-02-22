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
 *  property="user_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="title",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="caption",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="created_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="updated_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="deleted",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class Project extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'project';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function mia_user()
    {
        return $this->belongsTo(MiaUser::class, 'user_id');
    }


    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('project.deleted', 0);
        });
    }
}