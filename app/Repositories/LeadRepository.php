<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\LeadContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\Repositories\BaseRepository; 
/**
 * Class LeadRepository
 *
 * @package \App\Repositories
 */
class LeadRepository extends BaseRepository implements LeadContract
{
    use UploadAble;

    /**
     * LeadRepository constructor.
     * @param Lead $model
     */
    public function __construct(Lead $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listLeads(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findLeadById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Lead|mixed
     */
    public function createLead(array $params)
    {
        try {
            $params['description'] = addslashes(filter_var($params['description'],  FILTER_DEFAULT ));  
           
           
            $collection = collect($params);
            $status = $collection->has('status') ? 1 : 0;
            //$collection->description = htmlspecialchars( $collection->description ,ENT_QUOTES );            
        
             
            $merge = $collection->merge(compact('status'));

            $lead = new Lead($merge->all());

            $lead->save();

            return $lead;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateLead(array $params)
    {   
        
        
        $lead = $this->findLeadById($params['lead_id']);

        $collection = collect($params)->except('_token');
      
        $status = $collection->has('status') ? 1 : 0;

        $merge = $collection->merge(compact('status'));

        $lead->update($merge->all());

        return $lead;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteLead($id)
    {
        $lead = $this->findLeadById($id);

        $lead->delete();

        return $lead;
    }

    
}
