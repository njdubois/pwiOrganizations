<div class="form_container" >
    <form  method="post" id="form" enctype="multipart/form-data">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="image_div" >
            <img
                src="/images/logos/{{ (isset($organizationDetails['logo_filename']) && $organizationDetails['logo_filename']) ?  $organizationDetails['logo_filename'] : "empty-profile.gif" }}"
                class="organization_logo"
                id="logo_image_sample"
            />

            <br />




            <div style='height: 20px;width: 200px; overflow:hidden;'>
                <input  type="file" onchange="readURL(this);" id="logo_file" name="logo_file" value="{{  (isset($organizationDetails['logo_filename']) && $organizationDetails['logo_filename']) ?  $organizationDetails['logo_filename'] : ""  }}" />

            </div>



            <button class="green_button" onclick="document.getElementById('logo_file').click();">
                Upload
            </button>
        </div>

        <div class="organization_form" >

                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="input_container">
                    <input
                            data-parsley-required
                            type="text"
                           id="organizationName"
                           name="organizationName"
                           class="default_input organization_input"
                           size="50"
                           placeholder="Enter Organization Name"
                           value="{{ isset($organizationDetails['name']) ? $organizationDetails['name'] : "" }}"
                    />
                </div>

                <div class="input_container">
                    <input
                            data-parsley-required
                            type="text"
                           id="organizationEstablishedDate"
                           name="organizationEstablishedDate"
                           class="default_input organization_input establishedDatePicker"
                           size="20"
                           placeholder="Pick an Established Date"
                           value="{{ isset($organizationDetails['established']) ? $organizationDetails['established'] : "" }}"
                    />
                </div>

                <div class="input_container">
                    <p class="input_label">
                        Causes
                    </p>

                    @foreach($allCauses as $key => $aCauseLabel)
                        <label>
                        <div class="cause_checkbox_container">
                            <input
                                    data-parsley-mincheck="1" required
                                    name="cause_list[]"
                                    type="checkbox"
                                    value="{{ $key }}"
                                    {{ (isset($organizationDetails['causes']) && array_key_exists($key, $organizationDetails['causes']) ) ? "CHECKED" : "" }}
                            />
                            {{ $aCauseLabel }}

                        </div></label>


                    @endforeach
                </div>

                <div class="input_container" style="margin-top:20px;">
                    <select
                            data-parsley-required
                            id="organizationRevenue"
                            name="organizationRevenue"
                            class="default_select organization_select"

                    >
                        <option value="" style="color:gray;">
                            Revenue Range
                        </option>

                        @foreach($allRevenues as $aRevenueLabel)
                            <option value="{{ $aRevenueLabel['id'] }}" {{ ( isset($organizationDetails['revenue_id'])   &&   $aRevenueLabel['id'] == $organizationDetails['revenue_id'] ) ? "SELECTED" : "" }}>
                                {{ $aRevenueLabel['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input_container" align="right">
                    <button type="submit" class="green_button">
                        Save
                    </button>
                </div>


        </div>
    </form>
    <script type="text/javascript">
        $('#form').parsley();


        $('.establishedDatePicker').datepicker({
            format: 'mm/dd/yyyy',

        });

        function readURL(input) {
            console.log("Image selected");
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo_image_sample')
                            .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
</div>