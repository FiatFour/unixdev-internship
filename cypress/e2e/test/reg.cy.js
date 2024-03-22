describe('register',()=>{
    beforeEach(()=>{
        cy.visit('register');
    })
    let namead = "somsak";
    let emailad = "admin@example.com";
    let passwordad = "123456789";

    let namemanager = "somsri";
    let emailmanager = "manager@example.com";
    let passwordmanager = "123456789";

    let nameemp = "somsawas";
    let emailemp = "empployee@example.com";
    let passwordemp = "123456789";
    it('admins can register',()=>{
        cy.getElementByFullName('name').type(namead).should('be.visible');
        cy.getElementByFullName('email').type(emailad).should('be.visible');
        cy.getElementByFullName('password').type(passwordad).should('be.visible');
        cy.getElementByFullName('confirmPassword').type(passwordad).should('be.visible');
        cy.getElementByFullName('register').click();
    });
    it('manager can register',()=>{
        cy.getElementByFullName('name').type(namemanager).should('be.visible');
        cy.getElementByFullName('email').type(emailmanager).should('be.visible');
        cy.getElementByFullName('password').type(passwordmanager).should('be.visible');
        cy.getElementByFullName('confirmPassword').type(passwordmanager).should('be.visible');
        cy.getElementByFullName('register').click();
    });
    it('employee can register',()=>{
        cy.getElementByFullName('name').type(nameemp).should('be.visible');
        cy.getElementByFullName('email').type(emailemp).should('be.visible');
        cy.getElementByFullName('password').type(passwordemp).should('be.visible');
        cy.getElementByFullName('confirmPassword').type(passwordemp).should('be.visible');
        cy.getElementByFullName('register').click();
    });
});