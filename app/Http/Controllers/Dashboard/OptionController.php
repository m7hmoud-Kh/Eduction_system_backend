<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OptionResource;
use App\Http\Requests\Dashboard\Option\OptionStoreRequest;
use App\Http\Requests\Dashboard\Option\OptionUpdateRequest;

class OptionController extends Controller
{
    public function getOptionsByQuestionId($questionId)
    {
        $options = Option::with('question')->where('question_id', $questionId)->get();

        if ($options) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' =>  OptionResource::collection($options)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function store(OptionStoreRequest $request)
    {
        $option =  Option::create($request->all());
        return response()->json([
            'message' => 'Created Successfully',
            'status' => Response::HTTP_CREATED,
            'data' => new OptionResource($option)
        ]);
    }

    public function show($id)
    {
        $option = Option::whereId($id)->first();

        if ($option) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' => new OptionResource($option)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function update(OptionUpdateRequest $request, $id)
    {
        $option = Option::findOrFail($id);
        $option->update($request->all());
        return response()->json([
            'message' => 'Update',
            'status' => Response::HTTP_NO_CONTENT
        ]);
    }

    public function destory($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();
        return response()->json([
            'message' => 'Delete',
            'status' => Response::HTTP_NO_CONTENT,
        ]);
    }
}
