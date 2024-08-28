@extends('layouts.modme')

@section('title')
    Bosh sahifa
@endsection

@section('content')

    <div class="container justify-content-center col-8">
        <div class="row">
            <div class="">
                <div class="table-responsive w-auto">
                    <h3>Kompaniya nomi:  {{$company->name}}</h3><br>

                    <div class="card-header">
                        <label for="guruhToken" class="p-3">Tilda uchun token:</label>
                        <input id="guruhToken" type="text" value="{{ $company->modme_token }}" style="position: absolute; left: -9999px;">
                        <span>{{ $company->modme_token}}</span>
                        <button id="copyTokenButton" class="btn btn-primary m-2" onclick="copyToClipboard('guruhToken', 'copyIcon', 'notification')">
                            <span id="copyIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                </svg>
                            </span>
                        </button>
                        <div id="notification" style="display: none; width: 100%; position: absolute; left: -9999px;"></div>
                    </div>
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col-6">#</th>
                        <th scope="col-6">Filial nomi</th>
                        <th scope="col-6">Branch ID</th>
                        <th scope="col-6">Copy ID</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($company->branches as $branch)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $branch['name'] }}</td>
                            <td id="branch-id-{{ $loop->iteration }}">{{ $branch['id'] }}</td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center" style="position: relative;">
                                    <button class="btn btn-primary" onclick="copyToClipboard('linkInput{{ $branch['id'] }}', 'copyIcon{{ $branch['id'] }}', 'copyNotification{{ $branch['id'] }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" id="copyIcon{{ $branch['id'] }}">
                                            <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                        </svg>
                                    </button>
                                    <div id="copyNotification{{ $branch['id'] }}" class="text-success" style="display: none; position: absolute; top: -20px; right: 0;">
                                    </div>
                                </div>
                                <input type="text" id="linkInput{{ $branch['id'] }}" value="{{ $branch['id'] }}" readonly style="width: 100%; position: absolute; left: -9999px;">
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <p>
                    Tildadan foydalanishda: <br> Name, Phone, Comments <br>
                    kabi o'zgaruvchilardan foydalanish kerak, qo'shimcha Phone form qilishda dublikat degani ustiga bosib, qo'shmcha no'mer deb yozish kerak,<br> Phone_1 Phone_2 shunaqa bo'lib keladi va leadlar bo'limida qo'shimcha narsalar comment ga yoziladi
                  </p>
                </div>
              </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.querySelectorAll('.copy-icon').forEach(function(copyIcon) {
        copyIcon.addEventListener('click', function(event) {
            event.preventDefault();
            var branchId = copyIcon.getAttribute('data-branch-id');
            navigator.clipboard.writeText(branchId).then(function() {
                alert('Copied: ' + branchId);
            }).catch(function(error) {
                alert('Failed to copy: ' + error);
            });
        });
    });
</script>
@endsection
