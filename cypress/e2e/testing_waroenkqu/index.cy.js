/// <reference types="cypress" />

describe('User can see index page', () => {
    it('Index opened', () => {
      cy.visit("http://127.0.0.1:8000/");
      cy.get('.main-menu > ul > :nth-child(1) > a').should('have.text', 'Home');
      cy.get('.main-menu > ul > :nth-child(2) > a').should('have.text', 'About');
      cy.get('.main-menu > ul > :nth-child(3) > a').should('have.text', 'Shop');
      cy.get(':nth-child(4) > .nav-link').should('have.text', 'Login');
      cy.get(':nth-child(5) > .nav-link').should('have.text', 'Register');
    })
  })