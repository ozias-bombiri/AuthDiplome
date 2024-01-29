@hasrole(['SCOLARITE'])
<hr>
    @include('navs.nav-direction')
@endhasrole



@hasrole(['DAOI'])
<hr>
    @include('navs.nav-daoi')
@endhasrole



@hasrole(['authentification'])
<hr>
    @include('navs.nav-authentification')
@endhasrole


@hasrole(['admin', 'SUPERADMIN'])
<hr>
    @include('navs.nav-admin')
@endhasrole