import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'http://localhost/api/demo'; // ⚠️ temporaire, on mettra une variable d’env plus tard

  constructor(private http: HttpClient) {}

  getDemo(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }
}
