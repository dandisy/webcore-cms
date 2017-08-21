@role(['superadministrator','administrator','verificator','user'])
<li class="header">DASHBOARD</li>

<li class="treeview">
    <a href="{!! url('admin/home') !!}"><i class="fa fa-area-chart"></i><span>Stats</span></a>
</li>

<li class="header">PUBLISH</li>

<li class="{{ Request::is('admin/information*') ? 'active' : '' }}">
    <a href="{!! route('information.index') !!}"><i class="fa fa-info-circle"></i><span>Informasi</span></a>
</li>

<li class="{{ Request::is('admin/regulations*') ? 'active' : '' }}">
    <a href="{!! route('regulations.index') !!}"><i class="fa fa-institution"></i><span>Regulasi</span></a>
</li>

<li class="{{ Request::is('admin/archives*') ? 'active' : '' }}">
    <a href="{!! route('archives.index') !!}"><i class="fa fa-edit"></i><span>Arsip</span></a>
</li>

<li class="{{ Request::is('admin/pages*') ? 'active' : '' }}">
    <a href="{!! route('pages.index') !!}"><i class="fa fa-sticky-note"></i><span>Pages</span></a>
</li>

{{--<li class="{{ Request::is('components*') ? 'active' : '' }}">
    <a href="{!! route('components.index') !!}"><i class="fa fa-puzzle-piece"></i><span>Components</span></a>
</li>--}}

<li class="header">SERVICE</li>

<li class="{{ Request::is('admin/requests*') ? 'active' : '' }}">
    <a href="{!! route('requests.index') !!}"><i class="fa fa-send"></i><span>Permohonan</span></a>
</li>

<li class="{{ Request::is('admin/exceptions*') ? 'active' : '' }}">
    <a href="{!! route('exceptions.index') !!}"><i class="fa fa-exclamation-circle"></i><span>Keberatan</span></a>
</li>

<li class="{{ Request::is('admin/responses*') ? 'active' : '' }}">
    <a href="{!! route('responses.index') !!}"><i class="fa fa-flag"></i><span>Tanggapan</span></a>
</li>

<li class="{{ Request::is('admin/faqs*') ? 'active' : '' }}">
    <a href="{!! route('faqs.index') !!}"><i class="fa fa-question"></i><span>Faqs</span></a>
</li>

<li class="header">ARRANGE</li>

<li class="{{ Request::is('admin/menus*') ? 'active' : '' }}">
    <a href="{!! route('menus.index') !!}"><i class="fa fa-bars"></i><span>Menus</span></a>
</li>

<li class="header">MASTER</li>

<li class="{{ Request::is('admin/types*') ? 'active' : '' }}">
    <a href="{!! route('types.index') !!}"><i class="fa fa-edit"></i><span>Types</span></a>
</li>

<li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('admin/formats*') ? 'active' : '' }}">
    <a href="{!! route('formats.index') !!}"><i class="fa fa-edit"></i><span>Formats</span></a>
</li>

<li class="{{ Request::is('admin/origins*') ? 'active' : '' }}">
    <a href="{!! route('origins.index') !!}"><i class="fa fa-edit"></i><span>Origins</span></a>
</li>

<li class="header">MANAGE</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>

<li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('admin/profiles*') ? 'active' : '' }}">
    <a href="{!! route('profiles.index') !!}"><i class="fa fa-users"></i><span>Profiles</span></a>
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

