@extends('components.datatable')
@section('content')
@php($rand = rand(10000000,100000000))

  <div class="row">
    <div class="col-sm-8" style="">
        <div class="row">
            <div class="asset_report_card">
                    <h1>2560</h1>
                    <p>Total Assets</p>
            </div>
            <div class="asset_report_card">
                    <h1>2560</h1>
                    <p>Total User ID</p>
            </div>
            <div class="asset_report_card">
                    <h1>2560</h1>
                    <p>Total Port Number</p>
            </div>
            <div class="asset_report_card">
                    <h1>2560</h1>
                    <p>Total Assets Firmware</p>
            </div>
              <div class="asset_report_card">
                    <h1>2560</h1>
                    <p>Total Assets Firmware</p>
            </div>
            
        </div>
        <div style="margin-bottom: 2rem; margin-top: 2rem;">
            <h1 style="font-size: 22px; color: #2E5D93;" >Apply Filters</h1>
        </div>
        <div class="filter_cotainer filter_section row" >
            <div class="filter_dropdown" >
            
            </div>
            <div class="filter_section"  >
                <div>
                <div id="fieldset-search" class="{{ $rand }}">
    <div>
        <select class="column_search_select" name="where[]">
            <option value="" selected>Select Column</option>
            @foreach($columns as $key => $label)
                <option
                        {{ isset($index) && isset($request->where[$index]) && $request->where[$index] == $key ? 'selected' : '' }}
                        value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
        <select class="search_select_relation" style="margin-left:4px;" name="op[]">
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "=" ? 'selected' : '' }}>
                =
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "<" ? 'selected' : '' }} value="<">
                &lt;
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == ">" ? 'selected' : '' }} value=">">
                &gt;
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "<=" ? 'selected' : '' }} value="<=">
                &lt;=
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == ">=" ? 'selected' : '' }} value=">=">
                &gt;=
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "!=" ? 'selected' : '' }} value="!=">
                !=
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "LIKE %%" ? 'selected' : '' }} value="LIKE %%">
                LIKE %%
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "IN" ? 'selected' : '' }} value="IN">
                IN
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "IS NULL" ? 'selected' : '' }} value="IS NULL">
                IS NULL
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "NOT IN" ? 'selected' : '' }} value="NOT IN">
                NOT IN
            </option>
            <option {{ isset($index) && isset($request->op[$index]) && $request->op[$index] == "<" ? 'selected' : '' }} value="IS NOT NULL">
                IS NOT NULL
            </option>
        </select>
        <input type="search" class="search_select_relation" style="margin-left:4px;" name="val[]" placeholder="Enter keyword here"
               value="{{ isset($index) && isset($request->op[$index]) ? $request->val[$index] : '' }}">
               <button class="add_btn" style="margin-left:4px;">
             <img src="{{ URL::asset ('/assets/images/addWhiteIcon.svg') }}" alt="" height="18" width="18">
        </button>
        <button class="add_btn" style="margin-left:4px;">
             <img src="{{ URL::asset ('/assets/images/refreshWhiteIcon.svg') }}" alt="" height="18" width="18">
        </button>
        <!-- <button onclick="deleteFilterRow('{{ $rand }}')" title="Delete"
                type="button" style="display: inline"
                class="btn btn-light btn-form btn-no-color dropdown-toggle btn_delete_row" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-trash-alt"></i>
        </button> -->
        

    </div>
</div>
                </div>
            <div style="height: 210px; overflow-y: scroll;">          
                    <table class="table table-condensed" >
                        <thead>
                        <tr style="height: 50px;">
                            <th style="padding: 10px;"></th>
                            <th style="font-size: 16px; color: #2E5D93; padding: 10px;">where</th>
                            <th style="font-size: 16px; color: #2E5D93; padding: 10px;">condition</th>
                            <th style="font-size: 16px; color: #2E5D93; padding: 10px;">value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr><tr>
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        <tr style="height: 50px;">
                            <td style="padding-top: 1rem;">
                                <img src="{{ URL::asset ('/assets/images/cross.svg') }}" alt="" height="18" width="18">
                            </td>
                            <td style="padding-top: 1rem;">John</td>
                            <td style="padding-top: 1rem;">Doe</td>
                            <td style="padding-top: 1rem;">john@example.com</td>
                        </tr>
                        
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4" style="padding:0px;">
            <div class="asset_report_colums" style="border-top-left-radius:8px; border-top-right-radius: 8px;" >
                <div class="filter_container">
                    <div class="search_container">
                            <p>Search</p>
                            <input type="text">
                    </div>
                </div>

                <div class="filter_container">
                    <div class="search_container">
                            <p>Display</p>
                            <div class="dropdown" style="width:320px";>
                                <button  type="button" class="btn dropdown-toggle filter_dropdown_asset" data-bs-toggle="dropdown">
                                     <img src="{{ URL::asset ('/assets/images/downArrow.svg') }}" alt="" >

                                </button>
                                <ul class="dropdown-menu" style="    width: 100%;">
                                    <li><a class="dropdown-item" href="#">Link 1</a></li>
                                    <li><a class="dropdown-item" href="#">Link 2</a></li>
                                    <li><a class="dropdown-item" href="#">Link 3</a></li>
                                </ul>
                            </div>
                    </div>
                </div>

                <div class="column_selection_container">
                        <div class="section_one"  >
                                   <div class="toggle_section">
                                   <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    
                                    <!-- toggle section -->
                                    <div >
                                        <div class="toggled_section" id="target_toggle">
                                        <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                            
                            
                            
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div><div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                    <div class="filter_container options_assets" >
                                        <div class="option_container" >
                                                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" >
                                                <p>Asset Hierarchy</p>
                                                
                                        </div>
                                    </div>
                                        </div>
                                        
                                    </div>

                                   </div>
                                   
                                    
                                    <div class="button_toggle">
                                        <button id="toggle"  >
                                            <img src="{{ URL::asset ('/assets/images/whiteDownArrow.svg') }}" alt="" height="10px" >
                                         </button>
                                    </div> 
                        </div>
                                    
                        </div>
 
               
                </div>
            </div>
    </div>
  </div>

 <div class="asset_table_container">
 <div style="margin-bottom: 2rem; margin-top: 2rem;">
            <h1 style="font-size: 22px; color: #2E5D93;" >Asset Report</h1>
        </div>
 <div class="asset_table_effect">
 <div class="row" style=" padding-top: 1rem;">
        <div class="row" style="margin-left: 0rem;">
        @include('filters.common')
            <!-- <div style="display: flex; margin-top: 1rem; margin-bottom: 1rem;">
                <img src="{{ URL::asset ('/assets/images/excel.svg') }}" alt="" height="28" width="22"  style="margin-left:12px;">
                <img src="{{ URL::asset ('/assets/images/pdf.svg') }}" alt="" height="28" width="22" style="margin-left:1rem;">
            </div> -->

        </div>
         <div class="table-responsive">          
            <table class="table asset_table">
                <thead>
                <tr style="padding-top: 8px; padding-bottom: 8px; background: #EFF2F7;"  >
                   
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Country</th>

                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Country</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                    
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                </tr>
                <tr>

                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                </tr>
                <tr>

                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                </tr>
                <tr>

                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                </tr>
                <tr>

                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                </tr>
                   <tr>

                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                    <td>Anna</td>
                    <td>Pitt</td>
                    <td>35</td>
                    <td>New York</td>
                    <td>USA</td>
                </tr>
                </tbody>
            </table>
        </div>
  </div>
 </div>
 </div>
@endsection