@if( isset($allOrganizations) && count($allOrganizations) > 0 )

    @foreach($allOrganizations as $anOrganization)

        <div>
            <div class="org_container">
                <div class="org_logo_container">
                    <img src="../images/logos/{{ $anOrganization['logo_filename'] }}" class="org_logo" />
                </div>

                <div class="bs org_details_container">
                    <p class="org_details_name">
                        {{ $anOrganization['name'] }}
                    </p>
                    <p class="org_details_established">
                        EST. {{ $anOrganization['established'] }}
                    </p>
                    <hr class="org_details_hr" />
                    <p class="org_details_cause_list">
                        CAUSES: {{ implode(", ", $anOrganization['causes']) }}
                    </p>
                    <p class="org_details_revenue">
                        REVENUE RANGE: {{ $anOrganization['revenue'] }}
                    </p>
                </div>

            </div>
            @if (isset($admin) && $admin)
                <a class="brand_main_button" href="{{ route('adminOrganizationEdit', [ "organization_id" => $anOrganization['id'] ] ) }}">
                    EDIT
                </a>
            @endif
        </div>
    @endforeach

@endif