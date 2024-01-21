@hasrole(['scolarite'])
<hr>
    @include('navs.nav-direction')
@endhasrole



@hasrole(['daoi'])
<hr>
    @include('navs.nav-daoi')
@endhasrole



@hasrole(['authentification'])
<hr>
    @include('navs.nav-authentification')
@endhasrole


@hasrole(['admin', 'superAdmin'])
<hr>
    @include('navs.nav-admin')
@endhasrole