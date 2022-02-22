<?php

namespace App\Handler\Client;
use Mia\Auth\Model\MIAUser;
/**
 * Description of DashboardHandler
 * 
 * @OA\Post(
 *     path="/client/dashboard",
 *     summary="Client Dashboard",
 *     tags={"Client"},
 *     @OA\RequestBody(
 *         description="Object query",
 *         required=false,
 *         @OA\MediaType(
 *             mediaType="application/json",                 
 *             @OA\Schema(
 *                  @OA\Property(
 *                      property="page",
 *                      type="integer",
 *                      description="Number of pace",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="where",
 *                      type="string",
 *                      description="Wheres | Searchs",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="withs",
 *                      type="array",
 *                      description="Array of strings",
 *                      example="[]"
 *                  ),
 *                  @OA\Property(
 *                      property="search",
 *                      type="string",
 *                      description="String of search",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="ord",
 *                      type="string",
 *                      description="Ord",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="asc",
 *                      type="integer",
 *                      description="Integer",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="limit",
 *                      type="integer",
 *                      description="Limit",
 *                      example="50"
 *                  )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Property(ref="#/components/schemas/MiaJsonResponse"),
 *                  @OA\Property(
 *                      property="response",
 *                      type="array",
 *                      @OA\Items(type="object", ref="#/components/schemas/Client")
 *                  )
 *              }
 *          )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class DashboardHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        $countAry = array(
            "zero"=>0, 
            "one"=>0, 
            "two"=>0, 
            "three"=>0, 
            "four"=>0, 
            "five"=>0, 
            "six"=>0, 
        );
        $allUser = MIAUser::select('*')->get();
        // return $allUser[0]
        for ($x = 0; $x <count($allUser); $x++) {
            switch ($this->fromNow($allUser[$x]->updated_at)) {
                case 0:
                    $countAry['zero']++;
                    break;
                case 1:
                    $countAry['one']++;
                    break;
                case 2:
                    $countAry['two']++;
                    break;
                case 3:
                    $countAry['three']++;
                    break;
                case 4:
                    $countAry['four']++;
                    break;
                case 5:
                    $countAry['five']++;
                    break;
                case 6:
                    $countAry['six']++;
                    break;                                        
                default:
                    break;
            }
        }
        return new \Mia\Core\Diactoros\MiaJsonResponse($countAry);
    }

    /**
     *  @param datetime
     *  @return diffDays
     * 
     */
    public function fromNow($time) {
        $now = time(); // or your date as well
        $your_date = strtotime($time);
        $datediff = $now - $your_date;
        return round($datediff / (60 * 60 * 24));
    }
}