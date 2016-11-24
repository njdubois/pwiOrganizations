<div class="form_container" >

    <div class="image_div" >
        <img src="/images/{{ $organizationDetails['logo_filename'] }}" class="organization_logo"/>
        <br />
        <button class="green_button">
            Upload
        </button>
    </div>

    <div class="organization_form" >
        <form  method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

            <div class="input_container">
                <input type="text"
                       id="organizationName"
                       name="organizationName"
                       class="default_input organization_input"
                       size="50"
                       placeholder="Enter Organization Name"
                       value="{{ isset($organizationDetails['name']) ? $organizationDetails['name'] : "" }}"
                />
            </div>

            <div class="input_container">
                <input type="text"
                       id="organizationEstablishedDate"
                       name="organizationEstablishedDate"
                       class="default_input organization_input"
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
                    <div class="cause_checkbox_container">
                        <input
                                name="cause_list[]"
                                type="checkbox"
                                value="{{ $key }}"
                                {{ array_key_exists($key, $organizationDetails['causes']) ? "CHECKED" : "" }}
                        />
                        {{ $aCauseLabel }}

                    </div>
                @endforeach
            </div>

            <div class="input_container" style="margin-top:20px;">

                <select
                        id="organizationRevenue"
                        name="organizationRevenue"
                        class="default_select organization_select"

                >
                    <option value="-1" style="color:gray;">
                        Revenue Range
                    </option>

                    @foreach($allRevenues as $aRevenueLabel)
                        <option value="{{ $key }}" {{ isset($organizationDetails['revenue']) && $aRevenueLabel['title'] == $organizationDetails['revenue'] ? "SELECTED" : "" }}>
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

        </form>
    </div>


</div>