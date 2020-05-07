<?php

namespace App\Imports;

use App\Transaction;
use App\Client;
use App\Deal;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $clientName = explode('@', $row[0])[0];
        $clientId = explode('@', $row[0])[1];
        // Check if new client 
        $client = Client::find($clientId);
        if(!$client) {
            //add new client 
            $client = new Client();
            $client->id = $clientId;
            $client->client = $clientName;
            $client->save();
        }
        
        $dealName = explode('#', $row[1])[0];
        $dealId = explode('#', $row[1])[1];
        // Check if new deal 
        $deal = Deal::find($dealId);
        if(!$deal) {
            //add new deal 
            $deal = new Deal();
            $deal->id = $dealId;
            $deal->deal = $dealName;
            $deal->save();
        }

        //add new transaction
        return new Transaction([
            'client_id'  => $clientId,
            'deal_id' => $dealId, 
            'accepted' => $row[3], 
            'refused' => $row[4], 
            'created_at' => date('Y-m-d H:i:s', strtotime($row[2])), 
        ]);
    }
}
