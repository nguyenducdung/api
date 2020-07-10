<?php

namespace App\Http\Requests\Table;

use App\Http\Requests\Base\BaseApiRequest;
use App\Services\TableService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateTableRequest extends BaseApiRequest
{
    protected $tableService;
    public function __construct(
        TableService $tableService,
        array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null
    )
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->tableService = $tableService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'numeric|required',
            'status' => 'numeric|required'
        ];
    }
    public function customAfterValidate()
    {
        $id = $this->id;
        $info = $this->tableService->find($id);
        if (!$info){
            throw new HttpResponseException(
                response()->json(['status' => JsonResponse::HTTP_BAD_REQUEST, 'error' => 'Table not found'], JsonResponse::HTTP_BAD_REQUEST)
            );
        }
    }

}
