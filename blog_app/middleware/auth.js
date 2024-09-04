export default function ({ $auth, redirect }) {

  if (!$auth.loggedIn) {
    // Allow access to the register page
    if (route.path !== '/register') {
      return redirect('/login');
    }
  } else {
    // If logged in and trying to access the register or login page, redirect to the home or dashboard page
    if (route.path === '/register' || route.path === '/login') {
      return redirect('/posts'); // Change to your desired post-login route
    }
  }
    // If the user is not authenticated
    // if (!$auth.loggedIn) {
    //   return redirect('/posts');
    // }
  } 