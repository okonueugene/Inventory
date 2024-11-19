@php
    $unread = \App\Models\Notification::whereNull('read_at')
        ->where('user_id', auth()->user()->id)
        ->get();

    $unread_count = \App\Models\Notification::whereNull('read_at')
        ->where('user_id', auth()->user()->id)
        ->count();

    $bg = $unread_count > 0 ? 'bg-danger' : 'bg-success';
@endphp

<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-expanded="false">
        <i class="ti ti-bell ti-md"></i>
        <span class="badge {{ $bg }} rounded-pill badge-notifications">{{ $unread_count }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end py-0">
        <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
                <h5 class="text-body mb-0 me-auto">Notifications</h5>
            </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container" id="scrollable-container">
            <ul class="list-group list-group-flush">
                @if ($unread_count > 0)
                    @foreach ($unread as $one)
                        @php
                            switch ($one->type) {
                                case 'new_asset':
                                    $acr = 'AS';
                                    break;
                                case 'new_audit':
                                    $acr = 'AU';
                                    break;
                                case 'new_category':
                                    $acr = 'CA';
                                    break;
                                case 'new_employee':
                                    $acr = 'EM';
                                    break;
                                case 'new_user':
                                    $acr = 'US';
                                    break;
                                default:
                                    $acr = 'NA';
                                    break;
                            }
                        @endphp
                        <li class="list-group-item list-group-item-action dropdown-notifications-item one-notification-link"
                            data-href="{{ $one->link }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <span
                                            class="avatar-initial rounded-circle bg-label-danger">{{ $acr }}</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $one->title }}</h6>
                                    <p class="mb-0">{{ $one->message }}</p>
                                    <small class="text-muted">{{ $one->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="flex-shrink-0 dropdown-notifications-actions">
                                    <a href="{{ $one->link }}" class="dropdown-notifications-read"><span
                                            class="badge badge-dot"></span></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <div class="alert alert-warning m-2">You don't have any unread notifications</div>
                @endif
            </ul>
        </li>
    </ul>
</li>
