<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TreeEntry;
use App\Models\TreeEntryLang;

class TestController extends Controller
{
		
    public function index(){
		$results = TreeEntry::with(['treeLang'])->get();

		$resultData = TreeEntry::with(['treeLang'])->where('parent_entry_id',0)->get();
		return view('tree',compact('results','resultData'));	
    }		
	
	public function getChildTree(Request $request){
		try{	
			if($request->ajax()){				
				if(!empty($request->entry_id)){
					$resultData = TreeEntry::with(['treeLang'])->where('parent_entry_id',$request->entry_id)->where('parent_entry_id','!=',0)->get();
					
					if($resultData){
						$data = '<ul id="treeview2" style="display: block;">';
						foreach($resultData as $result){
							$data .= '<li class="parent" id="child_'.$result->entry_id.'" data-id="'.$result->entry_id.'">';
							$data .= $result->entry_id.'. '.$result->treeLang->name;
							$data .= '</li>';
						}	
						$data .= '</ul>';	
						
						return json_encode(array('status'=>'success','message'=>'success','data'=>$data));
					}else{
						return json_encode(array('status'=>'success','message'=>'success','data'=>''));
					}	
				}else{
                    return json_encode(array('status'=>'error','message'=>'Please try again later.'));	
                }
			}
		}catch (Exception $e) {
            \Log::error($e->getMessage());
            abort(404);
        }		
	}
	
}
