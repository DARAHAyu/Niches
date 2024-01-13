<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; 

use App\Models\PurchaseOrder;

class PurchaseOrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->named('purchase-destroy')) {
            $purchase_order = PurchaseOrder::findOrFail($this->route('purchaseId'));
            return Auth::id() === $purchase_order->user_id;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:2000',
            'purchase_abstract' => 'required|max:2000',
            'category_id' => 'required|integer',
            'budget' => 'required|numeric',
            'schedule' => 'required|date',
        ];
    }
}
