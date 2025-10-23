import api from "./api";

interface LoginData {
  email: string;
  password: string;
}

interface RegisterData {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
}

interface User {
  id: number;
  name: string;
  email: string;
}

interface AuthResponse {
  token: string;
  user: User;
}

const authService = {
  login: async (data: LoginData): Promise<AuthResponse> => {
    const response = await api.post<AuthResponse>("/login", data);
    localStorage.setItem("token", response.data.token);
    return response.data;
  },

  register: async (data: RegisterData): Promise<AuthResponse> => {
    const response = await api.post<AuthResponse>("/register", data);
    localStorage.setItem("token", response.data.token);
    return response.data;
  },

  logout: () => {
    localStorage.removeItem("token");
  },

  getUser: async (): Promise<User> => {
    const response = await api.get<User>("/profile");
    return response.data;
  },
};

export default authService;
