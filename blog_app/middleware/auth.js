export default function ({ $auth, redirect }) {
    // If the user is not authenticated
    if (!$auth.loggedIn) {
      return redirect('/login');
    }
  }