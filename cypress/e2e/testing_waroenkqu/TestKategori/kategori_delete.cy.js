/// <reference types="cypress" />

describe('Admin can see kategori page', () => {
    it('Kategori test', () => {
      cy.visit("http://127.0.0.1:8000/login");
      cy.get('.card-header').should('have.text','Login');
      cy.get(':nth-child(2) > .col-md-4').should('have.text','Username');
      cy.get(':nth-child(3) > .col-md-4').should('have.text','Password');

      cy.get('#username').type("admin123",{ force: true });
      cy.get('#password').type('admin123',{ force: true });
      cy.get('.btn-primary').click({ force: true });

    cy.get('.nav > :nth-child(1) > .nav-link > p').should('have.text','Dashboard');
     cy.get(':nth-child(2) > .nav-link > p').should('have.text','Admin Profile');
     cy.get(':nth-child(3) > .nav-link > p').should('have.text','List Kategori');
     cy.get(':nth-child(4) > .nav-link > p').should('have.text','List Barang');
     cy.get(':nth-child(5) > .nav-link > p').should('have.text','List User');
     cy.get(':nth-child(6) > .nav-link > p').should('have.text','List Transaksi');

     cy.get(':nth-child(3) > .nav-link > p').click({ force: true });
     cy.get('.card-title').should('have.text',' Tabel Kategori Produk ');
     cy.get('a.btn-danger').should('have.text','Refresh');
     cy.get('.btn-warning').should('have.text','Tambah');

     cy.get('form > .btn-danger').click({ force: true });
     cy.get('.swal2-confirm').click({ force: true });
     cy.get('a.btn-danger').click({ force: true });
    })
  })