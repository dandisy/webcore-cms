@if(Request::is('stats*'))
<li class="header">DASHBOARD</li>

<li class="{{ Request::is('stats*') ? 'active' : '' }}">
    <a href="{!! url('stats') !!}"><i class="fa fa-area-chart"></i><span>Stats</span></a>
</li>
@endif

@if(Request::is('assets*'))
<li class="header">MANAGEMENT</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>
@endif

@role(['superadministrator','administrator'])
@if(Request::is('users*') or Request::is('profiles*') or Request::is('roles*') or Request::is('permissions*'))
<li class="header">MANAGEMENT</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('profiles.index') !!}"><i class="fa fa-edit"></i><span>Profiles</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-road"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="fa fa-ticket"></i><span>Permissions</span></a>
</li>
@endif

@if(Request::is('settings*'))
<li class="header">CONFIGURATION</li>

<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>
@endif
@endrole

@if(
    !Request::is('dashboard*') and
    !Request::is('stats*') and
    !Request::is('assets*') and
    !Request::is('users*') and
    !Request::is('profiles*') and
    !Request::is('roles*') and
    !Request::is('permissions*') and
    !Request::is('settings*')
    )
<li class="header">MANAGEMENT</li>

<li class="{{ Request::is('menu-manager*') ? 'active' : '' }}">
    <a href="{!! url('menu-manager') !!}"><i class="fa fa-bars"></i><span>Menus</span></a>
</li>

<li class="header">CONTENTS</li>

<li class="{{ Request::is('pages*') ? 'active' : '' }}">
    <a href="{!! route('admin.pages.index') !!}"><i class="fa fa-square"></i><span>Pages</span></a>
</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{!! route('admin.posts.index') !!}"><i class="fa fa-sticky-note"></i><span>Posts</span></a>
</li>

<li class="header">LAYOUTS</li>

<li class="{{ Request::is('presentations*') ? 'active' : '' }}">
    <a href="{!! route('admin.presentations.index') !!}"><i class="fa fa-sitemap"></i><span>Presentations</span></a>
</li>

<li class="{{ Request::is('components*') ? 'active' : '' }}">
    <a href="{!! route('admin.components.index') !!}"><i class="fa fa-paperclip"></i><span>Components</span></a>
</li>

<li class="header">DATA</li>

<li class="{{ Request::is('dataSources*') ? 'active' : '' }}">
    <a href="{!! route('admin.dataSources.index') !!}"><i class="fa fa-database"></i><span>Data Sources</span></a>
</li>

<li class="{{ Request::is('dataQueries*') ? 'active' : '' }}">
    <a href="{!! route('admin.dataQueries.index') !!}"><i class="fa fa-share-alt"></i><span>Data Queries</span></a>
</li>

<li class="{{ Request::is('dataColumns*') ? 'active' : '' }}">
    <a href="{!! route('admin.dataColumns.index') !!}"><i class="fa fa-table"></i><span>Data Columns</span></a>
</li>
@endif

