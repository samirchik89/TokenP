@extends('issuer.layout.base')

@section('title', 'Investors report')

@section('content')
    <div class="content-area py-1">
        <div style="margin-top:2%; margin-left:1%; margin-bottom:1%">
            <h3>Investors report</h3>
        </div>

        <!-- Project Selector -->
        <div class="container-fluid" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="project-selector" style="font-weight: bold; color: #333;">Select Project</label>
                        <select class="form-control" id="project-selector" name="project_id" style="border-radius: 5px; border: 1px solid #ddd;">
                            <option value="">All Projects</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ $selectedProjectId == $project->id ? 'selected' : '' }}>
                                    {{ $project->propertyName }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter the report by selecting a specific project</small>
                    </div>
                </div>
                @if($selectedProjectId)
                <div class="col-md-8">
                    <div class="alert alert-info" style="margin-top: 32px;">
                        <i class="fa fa-filter"></i> Showing data filtered for the selected project.
                        <a href="{{ route('report.investors') }}" class="btn btn-sm btn-outline-info ml-2">Clear Filter</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="container-fluid">
            <div class="box box-block bg-white">
            <table class="table table-striped table-bordered dataTable user-list-table" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Internal wallet share</th>
                        <th>External wallet share</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($investors as $index => $investor)
                        <tr>
                            <td>{{ $investor->name }}</td>
                            <td>{{ $investor->country->countryname }}</td>
                            <td>{{ $investor->investorShares->internal_wallet }}</td>
                            <td>{{ $investor->investorShares->external_wallet }}</td>
                            <td>{{ $investor->investorShares->internal_wallet + $investor->investorShares->external_wallet }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const projectSelector = document.getElementById('project-selector');

            projectSelector.addEventListener('change', function() {
                const selectedProjectId = this.value;
                const currentUrl = new URL(window.location);

                if (selectedProjectId) {
                    currentUrl.searchParams.set('project_id', selectedProjectId);
                } else {
                    currentUrl.searchParams.delete('project_id');
                }

                window.location.href = currentUrl.toString();
            });
        });
    </script>
@endsection
