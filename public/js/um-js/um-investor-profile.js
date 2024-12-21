document.addEventListener('DOMContentLoaded', () => {

const umInvestorProfileForm = document.querySelector('.um-investor-profile__form')
const umInvestorProfilePopapSg = document.querySelector('.um-investor-profile-popap-sg')
const umInvestorProfilePopapSgСlose = document.querySelector('.um-investor-profile-popap-sg__close')


    function formUmInvestorLpPopapFbCheck() {
        if(document.querySelector('.error') === null) {
            umInvestorProfilePopapSg.classList.add('um-investor-profile-popap--active')
        }
    }

    umInvestorProfileForm.addEventListener('submit', function() {
        setTimeout(() => formUmInvestorLpPopapFbCheck(), 1000)
    })

    umInvestorProfilePopapSgСlose.addEventListener('click', function() {
        umInvestorProfilePopapSg.classList.remove('um-investor-profile-popap--active')
    })
})