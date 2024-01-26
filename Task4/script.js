function showRegisterForm() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'flex';
    document.getElementById('message').innerText = '';
  }

  function showLoginForm() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'flex';
    document.getElementById('message').innerText = '';
  }

  function login() {
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;
    const storedUser = JSON.parse(localStorage.getItem(username));

    if (storedUser && storedUser.password === password) {
      // User is authenticated
      localStorage.setItem('loggedInUser', JSON.stringify(storedUser.username));
      showSecuredContent();
    } else {
      document.getElementById('message').innerText = 'Invalid username or password';
    }
  }

  function register() {
    const username = document.getElementById('registerUsername').value;
    const password = document.getElementById('registerPassword').value;
    const email = document.getElementById('registerEmail').value;

    const newUser = {
      username,
      password,
      email,
    };

    localStorage.setItem(username, JSON.stringify(newUser));
    document.getElementById('message').innerText = 'Registration successful! You can now log in.';
    showLoginForm();
  }

  function showSecuredContent() {
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    document.getElementById('loggedInUser').innerText = loggedInUser;
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('securedContent').style.display = 'block';
  }

  function logout() {
    localStorage.removeItem('loggedInUser');
    document.getElementById('securedContent').style.display = 'none';
    document.getElementById('loginForm').style.display = 'flex';
  }