@hasrole(['direction'])
    @include('navs.nav-direction')
@endhasrole

<hr>

@hasrole(['daoi'])
    @include('navs.nav-daoi')
@endhasrole

<hr>

@hasrole(['authentification'])
    @include('navs.nav-authentification')
@endhasrole
<hr>

@hasrole(['admin', 'superAdmin'])
    @include('navs.nav-admin')
@endhasrole