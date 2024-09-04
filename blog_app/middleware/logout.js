export default function ({ $auth, redirect }) {
    if ($auth.loggedIn) {
      $auth.logout().then(() => {
        redirect('/login');
      }).catch((error) => {
        console.error('Logout error:', error);
      });
    }
  }