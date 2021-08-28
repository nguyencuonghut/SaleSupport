<?php

namespace App\Http\Livewire;

use App\Imports\PriceImport;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportPriceComponent extends Component
{
    use WithFileUploads;
    public $file;

    public function import()
    {
        $rules = [
            'file'             => 'required|mimes:xlsx|max:2000',
        ];
        $messages = [
            'file.required' => 'Bạn phải nhập file dữ liệu.',
            'file.mimes' => 'Bạn phải nhập file dạng excel:xlsx.',
            'file.max' => 'File vượt quá dung lượng cho phép.',
        ];
        $this->validate($rules,$messages);
        //Import data
        try {
            Excel::import(new PriceImport, $this->file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

             foreach ($failures as $failure) {
                 $failure->row(); // row that went wrong
                 $failure->attribute(); // either heading key (if using heading row concern) or column index
                 $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
             }
        }
        Session::flash('success_message', 'Bảng giá được import thành công!');
        return redirect()->route('admin.prices');
    }

    public function render()
    {
        return view('livewire.import-price-component')->layout('layouts.base');
    }
}
