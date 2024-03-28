describe('testlogout',()=>{
    beforeEach(()=>{
        cy.visit('login');

    });
    it.only('admin can logout',()=>{
        cy.getElementByFullName('email').type('admin@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.location('pathname').should('equal','/admin/users');
        cy.getElementByFullName('dropDown').click();
        cy.getElementByFullName('logout').click();
        cy.location('pathname').should('equal','/login');
    });
    it('manager can logout',()=>{
        cy.getElementByFullName('email').type('manager@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.location('pathname').should('equal','/manager/survey-forms');
        cy.getElementByFullName('dropDown').click();
        cy.getElementByFullName('logout').click();
        cy.location('pathname').should('equal','/login');
    });
    it('employee can logout',()=>{
        cy.getElementByFullName('email').type('employee@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.location('pathname').should('equal','/employee/survey-responses');
        cy.getElementByFullName('dropDown').click();
        cy.getElementByFullName('logout').click();
        cy.location('pathname').should('equal','/login');
    });
});