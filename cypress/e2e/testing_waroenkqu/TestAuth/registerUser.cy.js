/// <reference types="cypress" />

describe('User can see register page', () => {
    it('Register Test', () => {
      cy.visit("http://127.0.0.1:8000/register");
        
      cy.get('.card-header').should('have.text', 'Register');
      cy.get(':nth-child(2) > .col-md-4').should('have.text', 'Username');
      cy.get(':nth-child(3) > .col-md-4').should('have.text', 'Name');
      cy.get(':nth-child(4) > .col-md-4').should('have.text', 'Email Address');
      cy.get(':nth-child(5) > .col-md-4').should('have.text', 'Password');
      cy.get(':nth-child(6) > .col-md-4').should('have.text', 'Confirm Password');

      cy.get('#username').type("user12345",{ force: true });
      cy.get('#name').type('ghani1234',{ force: true });
      cy.get('#email').type('user1234@mail.com',{ force: true });
      cy.get('#password').type('user12345',{ force: true });
      cy.get('#password-confirm').type('user12345',{ force: true });
      cy.get('.btn').click({ force: true });

    })
  })