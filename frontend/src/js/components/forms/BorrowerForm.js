export function createBorrowerForm(borrower = null) {
  return `
    <form id="borrower-form" class="space-y-4">
      <div class="space-y-2">
        <label class="text-sm font-medium text-card-foreground" for="name">Name</label>
        <input
          type="text"
          id="name"
          name="name"
          value="${borrower?.name || ''}"
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring"
          required
        />
      </div>
      <div class="space-y-2">
        <label class="text-sm font-medium text-card-foreground" for="email">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          value="${borrower?.email || ''}"
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring"
          required
        />
      </div>
      <div class="space-y-2">
        <label class="text-sm font-medium text-card-foreground" for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          value="${borrower?.password || ''}"
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring"
          required
        />
      </div>
      <div class="space-y-2">
        <label class="text-sm font-medium text-card-foreground" for="role">Role</label>
        <select
          id="role"
          name="role"
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus:outline-none focus:ring-2 focus:ring-ring"
          required
        >
          <option value="">Select Role</option>
          <option value="Admin" ${borrower?.role === 'Admin' ? 'selected' : ''}>Admin</option>
          <option value="Borrower" ${borrower?.role === 'Borrower' ? 'selected' : ''}>Borrower</option>
        </select>
      </div>
      <div class="flex justify-end space-x-2">
        <button
          type="submit"
          class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2"
        >
          ${borrower ? 'Update' : 'Add'} Borrower
        </button>
      </div>
    </form>
  `;
}