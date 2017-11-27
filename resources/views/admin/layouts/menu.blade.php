@role(['superadministrator','administrator','verificator','user'])
<li class="header">DASHBOARD</li>

<li class="treeview">
    <a href="{!! url('admin/home') !!}"><i class="fa fa-area-chart"></i><span>Stats</span></a>
</li>

{{--<li class="header">PUBLISH</li>

<li class="{{ Request::is('admin/pages*') ? 'active' : '' }}">
    <a href="{!! route('pages.index') !!}"><i class="fa fa-sticky-note"></i><span>Pages</span></a>
</li>--}}

{{--<li class="header">SERVICE</li>--}}

<li class="header">ARRANGE</li>

<li class="{{ Request::is('admin/menus*') ? 'active' : '' }}">
    <a href="{!! url('admin/menus') !!}"><i class="fa fa-bars"></i><span>Menus</span></a>
</li>

{{--<li class="header">MASTER</li>--}}

<li class="header">MANAGE</li>

<li class="{{ Request::is('admin/filemanager*') ? 'active' : '' }}">
    <a href="{!! url('admin/filemanager') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>

<li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>
@endrole

@role(['superadministrator','administrator'])
<li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-road"></i><span>Roles</span></a>
</li>

{{--<li class="{{ Request::is('admin/permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="fa fa-ticket"></i><span>Permissions</span></a>
</li>--}}
@endrole

@role(['superadministrator','administrator'])
<li class="header">CONFIGURE</li>

<li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>
@endrole

