<?php

namespace App\Http\Controllers;

use App\Http\Resources\Player as PlayerResource;
use App\Models\PlayerImportData;
use Illuminate\Http\Request;

class PlayerStatsController extends Controller
{
    private $playerImportData;

    public function __construct(PlayerImportData $playerImportData)
    {
        $this->playerImportData = $playerImportData->orderBy('reference_id');
    }
    public function index()
    {
        $playerResource = PlayerResource::collection(
            $this->playerImportData->paginate(100)
        );

        return response()->json($playerResource);
    }

    public function show($id)
    {
        $playerImportDataCollection = $this->playerImportData
            ->where('reference_id', (int) $id)
            ->firstOrFail();

        return response()->json(
            new PlayerResource($playerImportDataCollection)
        );
    }
}
