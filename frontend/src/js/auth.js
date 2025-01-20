import { login, logout } from './utils/api.js';
import { initializeAdminApp, initializeBorrowerApp } from './app.js';

export async function setupAuth() {
  const loginContainer = document.getElementById('login-container');
  const app = document.getElementById('app');

  // Create login form
  loginContainer.innerHTML = `
    <div class="min-h-screen bg-background flex items-center justify-center p-4">
      <div class="w-full max-w-md">
        <div class="bg-card rounded-lg shadow-xl p-8 border">
          <div class="flex flex-col items-center space-y-2 mb-8">
            <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <h2 class="text-2xl font-bold text-card-foreground">Library Management</h2>
            <p class="text-muted-foreground">Sign in to your account</p>
          </div>
          <form id="login-form" class="space-y-4">
            <div class="space-y-2">
              <label class="text-sm font-medium text-card-foreground" for="email">Email</label>
              <input
                type="email"
                id="email"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                required
              />
            </div>
            <div class="space-y-2">
              <label class="text-sm font-medium text-card-foreground" for="password">Password</label>
              <input
                type="password"
                id="password"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                required
              />
            </div>
            <button
              type="submit"
              class="w-full h-10 px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
            >
              Sign in
            </button>
          </form>
        </div>
      </div>
    </div>
  `;

  // Initialize theme
  setupThemeToggle();

  // Handle login form submission
  const loginForm = document.getElementById('login-form');
  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
      const response = await login({ email, password });

      loginContainer.classList.add('hidden');
      app.classList.remove('hidden');
      console.log(response.user.role);
      
      if (response.user.role === 'Admin') {
        initializeAdminApp();
      } else {
        initializeBorrowerApp();
      }
    } catch (error) {
      alert('Invalid credentials. Please try again.');
    }
  });

  // Check if user is already authenticated
  const token = localStorage.getItem('token');
  const user = JSON.parse(localStorage.getItem('user'));
  
  if (token && user) {
    loginContainer.classList.add('hidden');
    app.classList.remove('hidden');
    if (user.role === 'Admin') {
      initializeAdminApp();
    } else {
      initializeBorrowerApp();
    }
  }

  const logoutBtn = document.getElementById('logout-btn');
  logoutBtn.addEventListener('click', async () => {
    try {
      await logout();
      window.location.href = '/';
    } catch (error) {
      console.error('Logout failed:', error);
    }
  });
}

function setupThemeToggle() {
  const themeToggle = document.getElementById('theme-toggle');
  themeToggle?.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
  });

  // Initialize theme
  if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
}