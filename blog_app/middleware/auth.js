export default function ({ $auth, redirect }) {

  if (!$auth.loggedIn) {
    if (route.path !== '/register') {
      return redirect('/login');
    }
  } else {
    if (route.path === '/register' || route.path === '/login') {
    }
  }
  } 