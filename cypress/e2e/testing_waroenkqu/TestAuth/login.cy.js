/// <reference types="cypress" />

describe('User can see login page', () => {
    it('Login test', () => {
      cy.visit("http://127.0.0.1:8000/login");
      cy.get('.card-header').should('have.text','Login');
      cy.get(':nth-child(2) > .col-md-4').should('have.text','Username');
      cy.get(':nth-child(3) > .col-md-4').should('have.text','Password');

      cy.get('#username').type("admin123",{ force: true });
      cy.get('#password').type('admin123',{ force: true });
      cy.get('.btn-primary').click({ force: true });
      cy.get('.swal2-confirm').click({ force: true });
    })
  })