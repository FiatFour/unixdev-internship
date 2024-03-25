describe('register',()=>{
    beforeEach(()=>{
        cy.visit('login');
    })
    let emailad = "admin@example.com";
    let passwordad = "123456789";

    let emailmanager = "manager@example.com";
    let passwordmanager = "123456789";

    let emailemp = "empployee@example.com";
    let passwordemp = "123456789";
    it('admins can login',()=>{
        cy.location('pathname').should('equal','/login');
        cy.getElementByFullName('email').type(emailad).should('be.visible');
        cy.getElementByFullName('password').type(passwordad).should('be.visible');
        cy.getElementByFullName('login').click();
        cy.location('pathname').should('equal','/admin/users');
    });
    it('manager can login',()=>{
        cy.location('pathname').should('equal','/login');
        cy.getElementByFullName('email').type(emailmanager).should('be.visible');
        cy.getElementByFullName('password').type(passwordmanager).should('be.visible');
        cy.getElementByFullName('login').click();
        cy.location('pathname').should('equal','/manager/survey-forms');
    });
    it('employee can login',()=>{
        cy.location('pathname').should('equal','/login');
        cy.getElementByFullName('email').type(emailemp).should('be.visible');
        cy.getElementByFullName('password').type(passwordemp).should('be.visible');
        cy.getElementByFullName('login').click(); 
        cy.location('pathname').should('equal','/employee/survey-responses');
    });
});