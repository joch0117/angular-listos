import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common'; 
import {ApiService}  from '../../services/api.service';

@Component({
  selector: 'app-test-api',
  standalone: true,
  imports:[CommonModule],
  templateUrl: './test-api.component.html',
  styleUrl: './test-api.component.scss'
})
export class TestApiComponent implements OnInit {
  data: any;
  error:string | null=null;

  constructor(private apiService: ApiService){}

  ngOnInit():void{
    this.apiService.getDemo().subscribe({
      next:(response:any)=> { console.log('Réponse Api:',response);
        this.data =response; },
      error: (err:any) => { console.error('Erreur API :',err) ; this.error = 'Erreur : ' + err.message;}
    });
  }
}
