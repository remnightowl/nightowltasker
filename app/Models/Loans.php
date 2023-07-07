<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Loans extends Model
{
    protected $table = 'loans';

    protected $fillable = [
        'id',
        'loan_number',
        'branch',
        'requestor',
        'loan_coordinator',
        'borrower',
        'remarks',
        'demotech',
        'floodcert',
        'pulldrive',
        'agentapproval',
        'screenupdated'
    ];

    public static function AddLoan($data){

        $loan_id = DB::table('loans')
                    ->insertGetId([
                        'loan_number' => $data['loannumber'],
                        'branch' => $data['branch'],
                        'requestor' => $data['requestor'],
                        'loan_coordinator' => implode(',',$data['coordinator']),
                        'borrower' => $data['borrower'],
                        'remarks' => $data['loanremarks'],
                        'demotech' => $data['demotech'],
                        'floodcert' => $data['floodcert'],
                        'pulldrive' => $data['pulldrive'],
                        'agentapproval' => $data['agentapproval'],
                        'screenupdated' => $data['screenupdated'],
                    ]);

        return $loan_id;
    }

    public static function EditLoan($data){

        DB::table('loans')
            ->where('id', $data['loanid'])
            ->update([
                'loan_number' => $data['loannumber'],
                'branch' => $data['branch'],
                'requestor' => $data['requestor'],
                'loan_coordinator' => implode(',',$data['coordinator']),
                'borrower' => $data['borrower'],
                'remarks' => $data['loanremarks'],
                'demotech' => $data['demotech'],
                'floodcert' => $data['floodcert'],
                'pulldrive' => $data['pulldrive'],
                'agentapproval' => $data['agentapproval'],
                'screenupdated' => $data['screenupdated']
            ]);
    }
}
