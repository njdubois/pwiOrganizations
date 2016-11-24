@if( isset($allOrganizations) && count($allOrganizations) > 0 )

    @foreach($allOrganizations as $anOrganization)

        <div>
            <div class="org_container">
                <div class="org_logo_container">
                    <img src="../images/{{ $anOrganization['logo_filename'] }}" class="org_logo" />
                </div>

                <div class="org_details_container">
                    <div class="org_details_name">
                        {{ $anOrganization['name'] }}
                    </div>
                    <div class="org_details_established">
                        EST. {{ $anOrganization['established'] }}
                    </div>
                    <hr class="org_details_hr" />
                    <div class="org_details_cause_list">
                        CAUSES: {{ implode(", ", $anOrganization['causes']) }}
                    </div>
                    <div class="org_details_revenue">
                        REVENUE RANGE: {{ $anOrganization['revenue'] }}
                    </div>
                </div>
                @if (isset($admin) && $admin)
                    <a class="green_button" href="{{ route('adminOrganizationEdit', [ "organization_id" => $anOrganization['id'] ] ) }}">
                        EDIT
                    </a>
                @endif
            </div>

        </div>
    @endforeach

@endif