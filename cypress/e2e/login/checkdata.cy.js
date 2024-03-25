describe('',()=>{
    beforeEach(()=>{
        cy.visit('login');
    });
    it.only('admin check data',()=>{
        cy.getElementByFullName('email').type('admin@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.getElementByFullName('dropDown').click();
        cy.getElementByFullName('profile').click();
        
    });
    it('manager check data',()=>{
        cy.getElementByFullName('email').type('manager@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.getElementByFullName('dropDown').click();
        cy.getElementByFullName('profile').click();

    });
    it('employee check data',()=>{
        cy.getElementByFullName('email').type('employee@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.getElementByFullName('dropDown').click();
        cy.getElementByFullName('profile').click();
    });
});