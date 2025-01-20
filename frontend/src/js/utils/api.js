import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';

// Configure axios
const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

// Add auth token to requests
api.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Books
export async function getBooks() {
  const response = await api.get('/books');
  return response.data;
}

export async function getBookDetails(id) {
  const response = await api.get(`/books/${id}`);
  return response.data;
}

export async function addBook(book) {
  const response = await api.post('/books', book);
  return response.data;
}

export async function updateBook(id, updates) {
  const response = await api.patch(`/books/${id}`, updates);
  return response.data;
}

export async function deleteBook(id) {
  await api.delete(`/books/${id}`);
}

// Authors
export async function getAuthors() {
  const response = await api.get('/authors');
  return response.data;
}

export async function addAuthor(author) {
  const response = await api.post('/authors', author);
  return response.data;
}

export async function updateAuthor(id, updates) {
  const response = await api.put(`/authors/${id}`, updates);
  return response.data;
}

export async function deleteAuthor(id) {
  await api.delete(`/authors/${id}`);
}

// Borrowers
export async function getBorrowers() {
  const response = await api.get('/users');
  return response.data;
}

export async function getBorrower() {
  const response = await api.get(`/userinfo`);
  return response.data;
}

export async function addBorrower(borrower) {
  const response = await api.post('/users', borrower);
  return response.data;
}

export async function updateBorrower(id, updates) {
  const response = await api.patch(`/users/${id}`, updates);
  return response.data;
}

export async function deleteBorrower(id) {
  await api.delete(`/users/${id}`);
}

// Loans
export async function getLoans() {
  const response = await api.get('/loans');
  return response.data;
}

export async function addLoan(loan) {
  const response = await api.post('/loans', loan);
  return response.data;
}

export async function updateLoan(id, updates) {
  const response = await api.patch(`/loans/${id}`, updates);
  return response.data;
}

export async function deleteLoan(id) {
  await api.delete(`/loans/${id}`);
}

// Categories
export async function getCategories() {
  const response = await api.get('/categories');
  return response.data;
}

export async function addCategory(category) {
  const response = await api.post('/categories', category);
  return response.data;
}

export async function updateCategory(id, updates) {
  const response = await api.patch(`/categories/${id}`, updates);
  return response.data;
}

export async function deleteCategory(id) {
  await api.delete(`/categories/${id}`);
}

// Auth
export async function login(credentials) {
  const response = await api.post('/login', credentials);
  if (response.data.access_token) {
    localStorage.setItem('token', response.data.access_token);
    localStorage.setItem('user', JSON.stringify(response.data.user));
  }
  return response.data;
}
// export async function login(credentials) {
//   const response = await api.post('/login', credentials);
//   if (response.data.token) {
//     localStorage.setItem('token', response.data.token);
//     localStorage.setItem('user', JSON.stringify(response.data.user));
//   }
//   return response.data;
// }

export async function logout() {
  await api.post('/logout');
  localStorage.removeItem('token');
  localStorage.removeItem('user');
}

// Book Operations
export async function BorrowBook(borrowerId, bookId) {
  const response = await api.post(`books/${bookId}/borrow`);
  return response.data;
}

export async function ReturnBook(borrowerId, bookId) {
  const response = await api.post(`books/${bookId}/return`);
  return response.data;
}

export async function checkLoansDueDate(id) {
  const response = await api.get(`/loans/${id}/check-due-date`);
  return response.data;
}