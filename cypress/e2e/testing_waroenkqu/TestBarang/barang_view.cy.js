/// <reference types="cypress" />

describe('Admin can see barang page', () => {
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

      cy.get(':nth-child(4) > .nav-link > p').click({ force: true });
      cy.get('.card-title').should('have.text',' Table Barang');
      cy.get('.btn-warning').should('have.text','Tambah');

      cy.get('tr > :nth-child(1)').contains('No').and('be.visible');
      cy.get('tr > :nth-child(2)').contains('Kategori').and('be.visible');
      cy.get('[width="250px"]').contains('Aksi').and('be.visible');

      
    })
  })